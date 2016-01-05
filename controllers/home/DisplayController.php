<?php
	
	/*
	 * Controller for customer displays
	 * This class handles the customer displays
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	public class DisplayController extends CustomerController {
		
		/**
		 * The constructor of DisplayController
		 */
		public function __construct() {
			DisplayController::init();
		}
		
		private function init()
		{
			parent::init();

			$this->context->smarty->assign(array(
				// Usefull for layout.tpl
				'mobile_device' => $this->context->getMobileDevice(),
				'link' => $link,
				'cart' => $cart,
				'currency' => $currency,
				'cookie' => $this->context->cookie,
				'page_name' => $page_name,
				'hide_left_column' => !$this->display_column_left,
				'hide_right_column' => !$this->display_column_right,
				'base_dir' => _PS_BASE_URL_.__PS_BASE_URI__,
				'base_dir_ssl' => $protocol_link.Tools::getShopDomainSsl().__PS_BASE_URI__,
				'force_ssl' => Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE'),
				'content_dir' => $protocol_content.Tools::getHttpHost().__PS_BASE_URI__,
				'base_uri' => $protocol_content.Tools::getHttpHost().__PS_BASE_URI__.(!Configuration::get('PS_REWRITING_SETTINGS') ? 'index.php' : ''),
				'tpl_dir' => _PS_THEME_DIR_,
				'tpl_uri' => _THEME_DIR_,
				'modules_dir' => _MODULE_DIR_,
				'mail_dir' => _MAIL_DIR_,
				'lang_iso' => $this->context->language->iso_code,
				'language_code' => $this->context->language->language_code ? $this->context->language->language_code : $this->context->language->iso_code,
				'come_from' => Tools::getHttpHost(true, true).Tools::htmlentitiesUTF8(str_replace(array('\'', '\\'), '', urldecode($_SERVER['REQUEST_URI']))),
				'cart_qties' => (int)$cart->nbProducts(),
				'currencies' => Currency::getCurrencies(),
				'languages' => $languages,
				'meta_language' => implode(',', $meta_language),
				'priceDisplay' => Product::getTaxCalculationMethod((int)$this->context->cookie->id_customer),
				'is_logged' => (bool)$this->context->customer->isLogged(),
				'is_guest' => (bool)$this->context->customer->isGuest(),
				'add_prod_display' => (int)Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'),
				'shop_name' => Configuration::get('PS_SHOP_NAME'),
				'roundMode' => (int)Configuration::get('PS_PRICE_ROUND_MODE'),
				'use_taxes' => (int)Configuration::get('PS_TAX'),
				'show_taxes' => (int)(Configuration::get('PS_TAX_DISPLAY') == 1 && (int)Configuration::get('PS_TAX')),
				'display_tax_label' => (bool)$display_tax_label,
				'vat_management' => (int)Configuration::get('VATNUMBER_MANAGEMENT'),
				'opc' => (bool)Configuration::get('PS_ORDER_PROCESS_TYPE'),
				'PS_CATALOG_MODE' => (bool)Configuration::get('PS_CATALOG_MODE') || !(bool)Group::getCurrent()->show_prices,
				'b2b_enable' => (bool)Configuration::get('PS_B2B_ENABLE'),
				'request' => $link->getPaginationLink(false, false, false, true),
				'PS_STOCK_MANAGEMENT' => Configuration::get('PS_STOCK_MANAGEMENT'),
				'quick_view' => (bool)Configuration::get('PS_QUICK_VIEW'),
				'shop_phone' => Configuration::get('PS_SHOP_PHONE'),
				'compared_products' => is_array($compared_products) ? $compared_products : array(),
				'comparator_max_item' => (int)Configuration::get('PS_COMPARATOR_MAX_ITEM'),
				'currencyRate' => (float)$currency->getConversationRate(),
				'currencySign' => $currency->sign,
				'currencyFormat' => $currency->format,
				'currencyBlank' => $currency->blank,
			));

			$assign_array = array(
				'img_ps_dir' => _PS_IMG_,
				'img_cat_dir' => _THEME_CAT_DIR_,
				'img_lang_dir' => _THEME_LANG_DIR_,
				'img_prod_dir' => _THEME_PROD_DIR_,
				'img_manu_dir' => _THEME_MANU_DIR_,
				'img_sup_dir' => _THEME_SUP_DIR_,
				'img_ship_dir' => _THEME_SHIP_DIR_,
				'img_store_dir' => _THEME_STORE_DIR_,
				'img_col_dir' => _THEME_COL_DIR_,
				'img_dir' => _THEME_IMG_DIR_,
				'css_dir' => _THEME_CSS_DIR_,
				'js_dir' => _THEME_JS_DIR_,
				'pic_dir' => _THEME_PROD_PIC_DIR_
			);
		}
		
		/**
	     * @see CustomerController::checkAccess()
	     * @return boolean
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see CustomerController::viewAccess()
		 * @return boolean
		 */
		public function viewAccess() {
			return true;
		}
		
	}