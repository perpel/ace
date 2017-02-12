<?php
namespace common\libs\cache;
use Yii;

class AdminCache implements AdminCacheInterface
{
    static public function adminIdentityKey($adminID)
    {
        return self::ADMIN_NAVBAR_KEY . '_IDENTITY_KEY:' . $adminID;
    }

    static public function adminIdentityDel($adminID)
    {
        Yii::$app->cache->delete(AdminCache::adminIdentityKey($adminID));
        Yii::$app->cache->delete(AdminCache::ADMIN_NAVBAR_KEY);
    }

    static public function adminSiderBarDel()
    {
        Yii::$app->cache->delete(AdminCache::ADMIN_SIDERBAR_KEY);
    }
}