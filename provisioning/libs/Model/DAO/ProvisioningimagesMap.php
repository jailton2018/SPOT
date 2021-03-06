<?php
/** @package    Spot::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");

/**
 * ProvisioningimagesMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the ProvisioningimagesDAO to the provisioningImages datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package Spot::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class ProvisioningimagesMap implements IDaoMap
{
	/**
	 * Returns a singleton array of FieldMaps for the Provisioningimages object
	 *
	 * @access public
	 * @return array of FieldMaps
	 */
	public static function GetFieldMaps()
	{
		static $fm = null;
		if ($fm == null)
		{
			$fm = Array();
			$fm["Imagetarget"] = new FieldMap("Imagetarget","provisioningImages","imageTarget",false,FM_TYPE_INT,4,null,false);
			$fm["Imagename"] = new FieldMap("Imagename","provisioningImages","imageName",true,FM_TYPE_VARCHAR,255,null,false);
			$fm["Ostarget"] = new FieldMap("Ostarget","provisioningImages","osTarget",false,FM_TYPE_VARCHAR,255,null,false);
		}
		return $fm;
	}

	/**
	 * Returns a singleton array of KeyMaps for the Provisioningimages object
	 *
	 * @access public
	 * @return array of KeyMaps
	 */
	public static function GetKeyMaps()
	{
		static $km = null;
		if ($km == null)
		{
			$km = Array();
			$km["fk_imageTarget"] = new KeyMap("fk_imageTarget", "Imagetarget", "Mediatype", "Id", KM_TYPE_MANYTOONE, KM_LOAD_LAZY); // you change to KM_LOAD_EAGER here or (preferrably) make the change in _config.php
		}
		return $km;
	}

}

?>