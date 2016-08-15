<?php
namespace common\helpers;

class Logger{
    const LOG_COMMON = 'common';
    const LOG_DELETE = 'delete';

    const LOG_DIR = 'logs';
    const ERROR_LOG_FILE = 'error';

    public static function log($msg, $pre=null, $post="\n") {
        if (is_null($pre)) $pre = date('Y-m-d H:i:s ');
        echo $pre.$msg.$post;
    }

    /**
     * Получает весь консольный вывод, содержимое которого копирует в лог-файлы
     */
    protected static $_log_files = array();
    public static function console_output_handler($data, $flag) {
        $date = date('Y-m-d');
        foreach(static::$_log_files as $file=>$value) {
            file_put_contents(
                str_replace('{date}', $date, $file),
                $data,
                FILE_APPEND
            );
        }
        return UsefulHelper::consoleString($data);
    }
    /**
     * Добавляет в список лог-файл
     */
    public static function add_log_file($file) {
        if (strpos($file, '/') === false and strpos($file, '\\') === false) {
            $file = static::getLogFilename($file);
        }
        static::$_log_files[$file] = true;
    }

    /**
     * Убирает из списка лог-файл
     */
    public static function remove_log_file($file) {
        if (strpos($file, '/') === false or strpos($file, '\\') === false) {
            $file = static::getLogFilename($file);
        }
        if (!empty(static::$_log_files[$file])) {
            unset(static::$_log_files[$file]);
        }
    }
    

    protected static $log_dir = null;
    // Каталог для логов. Логи находятся в том же каталоге, что и крон скрипты (и логи крон-скриптов)
    public static function getLogDir() {
        if (self::$log_dir === null) {
            self::$log_dir = FilePathHelper::CreateOrReturnPath(FilePathHelper::getResourcesPath(static::LOG_DIR));
        }
        return self::$log_dir;
    }
    public static function getLogFilename($filename, $no_date=false) {
        $date = $no_date ? '' : '-{date}';
        return Logger::getLogDir().'/'.$filename.$date.'.log';
    }

    public static function getErrorLogFile() {
        return static::getLogFilename(static::ERROR_LOG_FILE);
    }

    public static function model($model_or_array) {
        if (is_object($model_or_array)) {
            self::info($model_or_array->getAttributes());
        } else if (is_array($model_or_array)) {
            $array = array();
            foreach($model_or_array AS $model) {
                $array[] = is_object($model) ? $model->getAttributes() : NULL;
            }
            self::info($array);
        }
    }

    public static function info(){
       $numargs = func_num_args();
       if ($numargs == 0) return false;
       print "<pre>";
       foreach (func_get_args() as $data){
           print_r($data);
           print "\n";
       }
       print "</pre>";
    }

    public static function warn($data=array(), $key=""){
        Logger::info($data, $key);
        exit;
    }

    public static function file($data=array(), $key=""){
        $log = "";

        foreach ($data as $key=>$item){
            if(is_array($item) || is_object($item)){
                foreach($item as $subkey=>$subitem){
                    $log .= "     [$subkey] => ".(is_array($subitem) ? join(',',$subitem) : $subitem)."\n\r";
                }
            }else{
                $log .= "[$key] => $item \n\r";
            }
        }
        file_put_contents(__DIR__.'/log.txt', $log, FILE_APPEND);
    }

    // Форматирует список ошибок модели для вывода в консоль
    public static function format_model_errors($msg, $model) {
        $result = array($msg, '');
        foreach ($model->getErrors() as $error) {
            $result[] = is_array($error) ? implode("\n", $error) : $error;
        }
        return implode("\n", $result);
    }

    public static function log_to_file($log, $message, $s = array()) {
        $s += array(
            'timestamp' => true,
            'echo' => true,
        );
        $message = rtrim($message)."\n";
        if (Yii::app()->params['generalSettings'][Settings::S_ENABLE_LOGGING]) {
            $logfile = str_replace(
                '{date}',
                date('Y-m-d'),
                self::getLogFilename($log)
            );
            file_put_contents($logfile, ($s['timestamp'] ? date('Y-m-d H:i:s ') : '').$message, FILE_APPEND);
        }
        if ($s['echo'] and Yii::app() instanceof CConsoleApplication) {
            echo $message;
        }
    }

    public static function rotate_logs() {
        $dir = static::getLogDir();
        $date = strtotime(date('Y-m-d'));
        chdir($dir);
        $logs = glob('*.log');
        foreach ($logs as $log) {
            if (preg_match('/\d{4}-\d{2}-\d{2}/', $log, $m)) {
                if (strtotime($m[0]) < $date) {
                    printf("Archiving log '%s'.\n", $log);
                    `zip -9 -m "$log.zip" "$log"`;
                }
            }
        }
    }
}
