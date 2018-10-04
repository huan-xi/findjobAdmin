<?php
/**
 * Created by IntelliJ IDEA.
 * User: huanxi
 * Date: 2018/10/4
 * Time: 20:03
 */

namespace app\index\extend;

class Constant
{
    private static $USER_JET_SERCRET = "micherhimmeCteqdi0";
    private static $VENDER_JWT_SERCRET = "micherhimVerderqdi0";
    //角色状态
    public static $ROUE_STATUS_NORMAL = "1";
    public static $ROUE_STATUS_FORBID = "2";
    //订单常量
    private static $ODER_STATUS_WAITE = "1";
    private static $ODER_STATUS_AGREE = "2";
    private static $ODER_STATUS_FINISH = "3";
    private static $ODER_STATUS_CANCEL = "4";
    private static $ODER_STATUS_DELETE = "5";
    //日志常量
    private static $Log_USER_USER = "1";
    private static $Log_USER_VENDER = "2";
    private static $Log_USER_ADMIN = "3";
    private static $Log_ORPRATE_CANCEL_ORDER = "1";

    /**
     * @return string
     */
    public static function getUSERJETSERCRET()
    {
        return self::$USER_JET_SERCRET;
    }

    /**
     * @return string
     */
    public static function getVENDERJWTSERCRET()
    {
        return self::$VENDER_JWT_SERCRET;
    }

    /**
     * @return string
     */
    public static function getROUESTATUSNORMAL()
    {
        return self::$ROUE_STATUS_NORMAL;
    }

    /**
     * @return string
     */
    public static function getROUESTATUSFORBID()
    {
        return self::$ROUE_STATUS_FORBID;
    }

    /**
     * @return string
     */
    public static function getODERSTATUSWAITE()
    {
        return self::$ODER_STATUS_WAITE;
    }

    /**
     * @return string
     */
    public static function getODERSTATUSAGREE()
    {
        return self::$ODER_STATUS_AGREE;
    }

    /**
     * @return string
     */
    public static function getODERSTATUSFINISH()
    {
        return self::$ODER_STATUS_FINISH;
    }

    /**
     * @return string
     */
    public static function getODERSTATUSCANCEL()
    {
        return self::$ODER_STATUS_CANCEL;
    }

    /**
     * @return string
     */
    public static function getODERSTATUSDELETE()
    {
        return self::$ODER_STATUS_DELETE;
    }

    /**
     * @return string
     */
    public static function getLogUSERUSER()
    {
        return self::$Log_USER_USER;
    }

    /**
     * @return string
     */
    public static function getLogUSERVENDER()
    {
        return self::$Log_USER_VENDER;
    }

    /**
     * @return string
     */
    public static function getLogUSERADMIN()
    {
        return self::$Log_USER_ADMIN;
    }

    /**
     * @return string
     */
    public static function getLogORPRATECANCELORDER()
    {
        return self::$Log_ORPRATE_CANCEL_ORDER;
    }


}
