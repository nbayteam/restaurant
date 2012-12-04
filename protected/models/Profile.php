<?php

/**
 * This is the model class for table "tbl_profile".
 *
 * The followings are the available columns in table 'tbl_profile':
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $gender
 * @property string $address
 * @property string $zipcode
 * @property string $birthdate
 * @property string $picture
 * @property string $gplus
 * @property string $facebook
 * @property string $twitter
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Profile extends CActiveRecord
{
	// Gender options
	const TYPE_FEMALE = 'Female';
	const TYPE_MALE = 'Male';


	// Country Code List		
	const COUNTRY_DZ = 213;		
	const COUNTRY_AD = 376;		
	const COUNTRY_AO = 244;		
	const COUNTRY_AI = 1264;	
	const COUNTRY_AG = 1268;	
	const COUNTRY_AR = 54;		
	const COUNTRY_AM = 374;		
	const COUNTRY_AW = 297;		
	const COUNTRY_AU = 61;		
	const COUNTRY_AT = 43;		
	const COUNTRY_AZ = 994;		
	const COUNTRY_BS = 1242;	
	const COUNTRY_BH = 973;		
	const COUNTRY_BD = 880;		
	const COUNTRY_BB = 1246;	
	const COUNTRY_BY = 375;		
	const COUNTRY_BE = 32;		
	const COUNTRY_BZ = 501;		
	const COUNTRY_BJ = 229;		
	const COUNTRY_BM = 1441;	
	const COUNTRY_BT = 975;		
	const COUNTRY_BO = 591;		
	const COUNTRY_BA = 387;		
	const COUNTRY_BW = 267;		
	const COUNTRY_BR = 55;		
	const COUNTRY_BN = 673;		
	const COUNTRY_BG = 359;		
	const COUNTRY_BF = 226;		
	const COUNTRY_BI = 257;		
	const COUNTRY_KH = 855;		
	const COUNTRY_CM = 237;		
	const COUNTRY_CA = 1;		
	const COUNTRY_CV = 238;		
	const COUNTRY_KY = 1345;	
	const COUNTRY_CF = 236;		
	const COUNTRY_CL = 56;		
	const COUNTRY_CN = 86;		
	const COUNTRY_CO = 57;		
	const COUNTRY_KM = 269;		
	const COUNTRY_CG = 242;		
	const COUNTRY_CK = 682;		
	const COUNTRY_CR = 506;		
	const COUNTRY_HR = 385;		
	const COUNTRY_CU = 53;		
	const COUNTRY_CY = 90392;	
	const COUNTRY_CS = 357;		
	const COUNTRY_CZ = 42;		
	const COUNTRY_DK = 45;		
	const COUNTRY_DJ = 253;		
	const COUNTRY_DM = 1809;	
	const COUNTRY_DO = 1809;	
	const COUNTRY_EC = 593;		
	const COUNTRY_EG = 20;		
	const COUNTRY_SV = 503;		
	const COUNTRY_GQ = 240;		
	const COUNTRY_ER = 291;		
	const COUNTRY_EE = 372;		
	const COUNTRY_ET = 251;		
	const COUNTRY_FK = 500;		
	const COUNTRY_FO = 298;		
	const COUNTRY_FJ = 679;		
	const COUNTRY_FI = 358;		
	const COUNTRY_FR = 33;		
	const COUNTRY_GF = 594;		
	const COUNTRY_PF = 689;		
	const COUNTRY_GA = 241;		
	const COUNTRY_GM = 220;		
	const COUNTRY_GE = 7880;	
	const COUNTRY_DE = 49;		
	const COUNTRY_GH = 233;		
	const COUNTRY_GI = 350;		
	const COUNTRY_GR = 30;		
	const COUNTRY_GL = 299;		
	const COUNTRY_GD = 1473;	
	const COUNTRY_GP = 590;		
	const COUNTRY_GU = 671;		
	const COUNTRY_GT = 502;		
	const COUNTRY_GN = 224;		
	const COUNTRY_GW = 245;		
	const COUNTRY_GY = 592;		
	const COUNTRY_HT = 509;		
	const COUNTRY_HN = 504;		
	const COUNTRY_HK = 852;		
	const COUNTRY_HU = 36;		
	const COUNTRY_IS = 354;		
	const COUNTRY_IN = 91;		
	const COUNTRY_ID = 62;		
	const COUNTRY_IR = 98;		
	const COUNTRY_IQ = 964;		
	const COUNTRY_IE = 353;		
	const COUNTRY_IL = 972;		
	const COUNTRY_IT = 39;		
	const COUNTRY_JM = 1876;	
	const COUNTRY_JP = 81;		
	const COUNTRY_JO = 962;		
	const COUNTRY_KZ = 7;		
	const COUNTRY_KE = 254;		
	const COUNTRY_KI = 686;		
	const COUNTRY_KP = 850;		
	const COUNTRY_KR = 82;		
	const COUNTRY_KW = 965;		
	const COUNTRY_KG = 996;		
	const COUNTRY_LA = 856;		
	const COUNTRY_LV = 371;		
	const COUNTRY_LB = 961;		
	const COUNTRY_LS = 266;		
	const COUNTRY_LR = 231;		
	const COUNTRY_LY = 218;		
	const COUNTRY_LI = 417;		
	const COUNTRY_LT = 370;		
	const COUNTRY_LU = 352;		
	const COUNTRY_MO = 853;		
	const COUNTRY_MK = 389;		
	const COUNTRY_MG = 261;		
	const COUNTRY_MW = 265;		
	const COUNTRY_MY = 60;		
	const COUNTRY_MV = 960;		
	const COUNTRY_ML = 223;		
	const COUNTRY_MT = 356;		
	const COUNTRY_MH = 692;		
	const COUNTRY_MQ = 596;		
	const COUNTRY_MR = 222;		
	const COUNTRY_YT = 269;		
	const COUNTRY_MX = 52;		
	const COUNTRY_FM = 691;		
	const COUNTRY_MD = 373;		
	const COUNTRY_MC = 377;		
	const COUNTRY_M1 = 976;		
	const COUNTRY_MS = 1664;	
	const COUNTRY_MA = 212;		
	const COUNTRY_MZ = 258;		
	const COUNTRY_M2 = 95;		
	const COUNTRY_NA = 264;		
	const COUNTRY_NR = 674;		
	const COUNTRY_N1 = 977;		
	const COUNTRY_NL = 31;		
	const COUNTRY_NC = 687;		
	const COUNTRY_NZ = 64;		
	const COUNTRY_NI = 505;		
	const COUNTRY_NE = 227;		
	const COUNTRY_NG = 234;		
	const COUNTRY_NU = 683;		
	const COUNTRY_NF = 672;		
	const COUNTRY_N2 = 670;		
	const COUNTRY_NO = 47;		
	const COUNTRY_OM = 968;		
	const COUNTRY_PW = 680;		
	const COUNTRY_PA = 507;		
	const COUNTRY_PG = 675;		
	const COUNTRY_PY = 595;		
	const COUNTRY_PE = 51;		
	const COUNTRY_PH = 63;		
	const COUNTRY_PL = 48;		
	const COUNTRY_PT = 351;		
	const COUNTRY_PR = 1787;	
	const COUNTRY_QA = 974;		
	const COUNTRY_RE = 262;		
	const COUNTRY_RO = 40;		
	const COUNTRY_RU = 7;		
	const COUNTRY_RW = 250;		
	const COUNTRY_SM = 378;		
	const COUNTRY_ST = 239;		
	const COUNTRY_SA = 966;		
	const COUNTRY_SN = 221;		
	const COUNTRY_SB = 381;		
	const COUNTRY_S3 = 248;		
	const COUNTRY_SL = 232;		
	const COUNTRY_SG = 65;		
	const COUNTRY_SK = 421;		
	const COUNTRY_S1 = 386;		
	const COUNTRY_SI = 677;		
	const COUNTRY_SO = 252;		
	const COUNTRY_ZA = 27;		
	const COUNTRY_ES = 34;		
	const COUNTRY_LK = 94;		
	const COUNTRY_SH = 290;		
	const COUNTRY_KN = 1869;	
	const COUNTRY_S4 = 1758;	
	const COUNTRY_SD = 249;		
	const COUNTRY_SR = 597;		
	const COUNTRY_SZ = 268;		
	const COUNTRY_SE = 46;		
	const COUNTRY_CH = 41;		
	const COUNTRY_S2 = 963;		
	const COUNTRY_TW = 886;		
	const COUNTRY_TJ = 7;		
	const COUNTRY_TH = 66;		
	const COUNTRY_TG = 228;		
	const COUNTRY_TO = 676;		
	const COUNTRY_TT = 1868;	
	const COUNTRY_TN = 216;		
	const COUNTRY_TR = 90;		
	const COUNTRY_T1 = 7;		
	const COUNTRY_T2 = 993;		
	const COUNTRY_TC = 1649;	
	const COUNTRY_TV = 688;		
	const COUNTRY_UG = 256;		
	const COUNTRY_GB = 44;		
	const COUNTRY_UA = 380;		
	const COUNTRY_AE = 971;		
	const COUNTRY_UY = 598;		
	const COUNTRY_US = 1;		
	const COUNTRY_UZ = 7;		
	const COUNTRY_VU = 678;		
	const COUNTRY_VA = 379;		
	const COUNTRY_VE = 58;		
	const COUNTRY_VN = 84;		
	const COUNTRY_VG = 84;		
	const COUNTRY_VI = 84;		
	const COUNTRY_WF = 681;		
	const COUNTRY_YN = 969;		
	const COUNTRY_YS = 967;		
	const COUNTRY_ZM = 260;		
	const COUNTRY_ZW = 263;		


	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Profile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_profile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('first_name, last_name, user_id, email', 'required'),
            array('first_name, last_name', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
            array('email', 'unique'),
			array('first_name, last_name, email', 'length', 'max'=>45),
			array('countrycode','length', 'max'=>4),
			array('phone', 'length', 'max'=>15),
			array('gender', 'length', 'max'=>6),
			array('picture', 'file', 
				'types'=>'jpg, gif, png',	// File type: jpg, gif, png
				'allowEmpty'=>true,
				'maxSize'=>1024*1024*2),	// Maximum size: 2MB
			array('address, picture, gplus, facebook, twitter', 'length', 'max'=>255),
			array('zipcode', 'length', 'max'=>6),
			array('birthdate', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, first_name, last_name, email, countrycode, phone, gender, address, zipcode, birthdate, picture, gplus, facebook, twitter', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'countrycode' => 'Country Code',
			'phone' => 'Phone',
			'gender' => 'Gender',
			'address' => 'Address',
			'zipcode' => 'Zipcode',
			'birthdate' => 'Birthdate',
			'picture' => 'Picture',
			'gplus' => 'Gplus',
			'facebook' => 'Facebook',
			'twitter' => 'Twitter',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('countrycode',$this->countrycode,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('gplus',$this->gplus,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('twitter',$this->twitter,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	protected function afterFind()
	{
		
		// list($y, $m, $d) = explode('-', $this->birthdate);
		// $mk = mktime(0, 0, 0, $m, $d, $y);
		// $this->birthdate = date('d-m-Y', $mk);

		return parent::afterFind();
	}

	protected function beforeSave()
	{
		// list($d, $m, $y) = explode('-', $this->birthdate);
		// $mk = mktime(0, 0, 0, $m, $d, $y);
		// $this->birthdate = date('Y-m-d', $mk);

		return parent::beforeSave();
	}



	public function  getGenderOptions()
	{
		return array(
			self::TYPE_FEMALE=>'Female',
			self::TYPE_MALE=>'Male',
		);
	}

	public function getCountryCodeOptions()
	{
		return array(
			self::COUNTRY_DZ =>'Algeria (+213)',
			self::COUNTRY_AD =>'Andorra (+376)',
			self::COUNTRY_AO =>'Angola (+244)',
			self::COUNTRY_AI =>'Anguilla (+1264)',
			self::COUNTRY_AG =>'Antigua & Barbuda (+1268)',
			self::COUNTRY_AR =>'Argentina (+54)',
			self::COUNTRY_AM =>'Armenia (+374)',
			self::COUNTRY_AW =>'Aruba (+297)',
			self::COUNTRY_AU =>'Australia (+61)',
			self::COUNTRY_AT =>'Austria (+43)',
			self::COUNTRY_AZ =>'Azerbaijan (+994)',
			self::COUNTRY_BS =>'Bahamas (+1242)',
			self::COUNTRY_BH =>'Bahrain (+973)',
			self::COUNTRY_BD =>'Bangladesh (+880)',
			self::COUNTRY_BB =>'Barbados (+1246)',
			self::COUNTRY_BY =>'Belarus (+375)',
			self::COUNTRY_BE =>'Belgium (+32)',
			self::COUNTRY_BZ =>'Belize (+501)',
			self::COUNTRY_BJ =>'Benin (+229)',
			self::COUNTRY_BM =>'Bermuda (+1441)',
			self::COUNTRY_BT =>'Bhutan (+975)',
			self::COUNTRY_BO =>'Bolivia (+591)',
			self::COUNTRY_BA =>'Bosnia Herzegovina (+387)',
			self::COUNTRY_BW =>'Botswana (+267)',
			self::COUNTRY_BR =>'Brazil (+55)',
			self::COUNTRY_BN =>'Brunei (+673)',
			self::COUNTRY_BG =>'Bulgaria (+359)',
			self::COUNTRY_BF =>'Burkina Faso (+226)',
			self::COUNTRY_BI =>'Burundi (+257)',
			self::COUNTRY_KH =>'Cambodia (+855)',
			self::COUNTRY_CM =>'Cameroon (+237)',
			self::COUNTRY_CA =>'Canada (+1)',
			self::COUNTRY_CV =>'Cape Verde Islands (+238)',
			self::COUNTRY_KY =>'Cayman Islands (+1345)',
			self::COUNTRY_CF =>'Central African Republic (+236)',
			self::COUNTRY_CL =>'Chile (+56)',
			self::COUNTRY_CN =>'China (+86)',
			self::COUNTRY_CO =>'Colombia (+57)',
			self::COUNTRY_KM =>'Comoros (+269)',
			self::COUNTRY_CG =>'Congo (+242)',
			self::COUNTRY_CK =>'Cook Islands (+682)',
			self::COUNTRY_CR =>'Costa Rica (+506)',
			self::COUNTRY_HR =>'Croatia (+385)',
			self::COUNTRY_CU =>'Cuba (+53)',
			self::COUNTRY_CY =>'Cyprus North (+90392)',
			self::COUNTRY_CS =>'Cyprus South (+357)',
			self::COUNTRY_CZ =>'Czech Republic (+42)',
			self::COUNTRY_DK =>'Denmark (+45)',
			self::COUNTRY_DJ =>'Djibouti (+253)',
			self::COUNTRY_DM =>'Dominica (+1809)',
			self::COUNTRY_DO =>'Dominican Republic (+1809)',
			self::COUNTRY_EC =>'Ecuador (+593)',
			self::COUNTRY_EG =>'Egypt (+20)',
			self::COUNTRY_SV =>'El Salvador (+503)',
			self::COUNTRY_GQ =>'Equatorial Guinea (+240)',
			self::COUNTRY_ER =>'Eritrea (+291)',
			self::COUNTRY_EE =>'Estonia (+372)',
			self::COUNTRY_ET =>'Ethiopia (+251)',
			self::COUNTRY_FK =>'Falkland Islands (+500)',
			self::COUNTRY_FO =>'Faroe Islands (+298)',
			self::COUNTRY_FJ =>'Fiji (+679)',
			self::COUNTRY_FI =>'Finland (+358)',
			self::COUNTRY_FR =>'France (+33)',
			self::COUNTRY_GF =>'French Guiana (+594)',
			self::COUNTRY_PF =>'French Polynesia (+689)',
			self::COUNTRY_GA =>'Gabon (+241)',
			self::COUNTRY_GM =>'Gambia (+220)',
			self::COUNTRY_GE =>'Georgia (+7880)',
			self::COUNTRY_DE =>'Germany (+49)',
			self::COUNTRY_GH =>'Ghana (+233)',
			self::COUNTRY_GI =>'Gibraltar (+350)',
			self::COUNTRY_GR =>'Greece (+30)',
			self::COUNTRY_GL =>'Greenland (+299)',
			self::COUNTRY_GD =>'Grenada (+1473)',
			self::COUNTRY_GP =>'Guadeloupe (+590)',
			self::COUNTRY_GU =>'Guam (+671)',
			self::COUNTRY_GT =>'Guatemala (+502)',
			self::COUNTRY_GN =>'Guinea (+224)',
			self::COUNTRY_GW =>'Guinea - Bissau (+245)',
			self::COUNTRY_GY =>'Guyana (+592)',
			self::COUNTRY_HT =>'Haiti (+509)',
			self::COUNTRY_HN =>'Honduras (+504)',
			self::COUNTRY_HK =>'Hong Kong (+852)',
			self::COUNTRY_HU =>'Hungary (+36)',
			self::COUNTRY_IS =>'Iceland (+354)',
			self::COUNTRY_IN =>'India (+91)',
			self::COUNTRY_ID =>'Indonesia (+62)',
			self::COUNTRY_IR =>'Iran (+98)',
			self::COUNTRY_IQ =>'Iraq (+964)',
			self::COUNTRY_IE =>'Ireland (+353)',
			self::COUNTRY_IL =>'Israel (+972)',
			self::COUNTRY_IT =>'Italy (+39)',
			self::COUNTRY_JM =>'Jamaica (+1876)',
			self::COUNTRY_JP =>'Japan (+81)',
			self::COUNTRY_JO =>'Jordan (+962)',
			self::COUNTRY_KZ =>'Kazakhstan (+7)',
			self::COUNTRY_KE =>'Kenya (+254)',
			self::COUNTRY_KI =>'Kiribati (+686)',
			self::COUNTRY_KP =>'Korea North (+850)',
			self::COUNTRY_KR =>'Korea South (+82)',
			self::COUNTRY_KW =>'Kuwait (+965)',
			self::COUNTRY_KG =>'Kyrgyzstan (+996)',
			self::COUNTRY_LA =>'Laos (+856)',
			self::COUNTRY_LV =>'Latvia (+371)',
			self::COUNTRY_LB =>'Lebanon (+961)',
			self::COUNTRY_LS =>'Lesotho (+266)',
			self::COUNTRY_LR =>'Liberia (+231)',
			self::COUNTRY_LY =>'Libya (+218)',
			self::COUNTRY_LI =>'Liechtenstein (+417)',
			self::COUNTRY_LT =>'Lithuania (+370)',
			self::COUNTRY_LU =>'Luxembourg (+352)',
			self::COUNTRY_MO =>'Macao (+853)',
			self::COUNTRY_MK =>'Macedonia (+389)',
			self::COUNTRY_MG =>'Madagascar (+261)',
			self::COUNTRY_MW =>'Malawi (+265)',
			self::COUNTRY_MY =>'Malaysia (+60)',
			self::COUNTRY_MV =>'Maldives (+960)',
			self::COUNTRY_ML =>'Mali (+223)',
			self::COUNTRY_MT =>'Malta (+356)',
			self::COUNTRY_MH =>'Marshall Islands (+692)',
			self::COUNTRY_MQ =>'Martinique (+596)',
			self::COUNTRY_MR =>'Mauritania (+222)',
			self::COUNTRY_YT =>'Mayotte (+269)',
			self::COUNTRY_MX =>'Mexico (+52)',
			self::COUNTRY_FM =>'Micronesia (+691)',
			self::COUNTRY_MD =>'Moldova (+373)',
			self::COUNTRY_MC =>'Monaco (+377)',
			self::COUNTRY_M1 =>'Mongolia (+976)',
			self::COUNTRY_MS =>'Montserrat (+1664)',
			self::COUNTRY_MA =>'Morocco (+212)',
			self::COUNTRY_MZ =>'Mozambique (+258)',
			self::COUNTRY_M2 =>'Myanmar (+95)',
			self::COUNTRY_NA =>'Namibia (+264)',
			self::COUNTRY_NR =>'Nauru (+674)',
			self::COUNTRY_N1 =>'Nepal (+977)',
			self::COUNTRY_NL =>'Netherlands (+31)',
			self::COUNTRY_NC =>'New Caledonia (+687)',
			self::COUNTRY_NZ =>'New Zealand (+64)',
			self::COUNTRY_NI =>'Nicaragua (+505)',
			self::COUNTRY_NE =>'Niger (+227)',
			self::COUNTRY_NG =>'Nigeria (+234)',
			self::COUNTRY_NU =>'Niue (+683)',
			self::COUNTRY_NF =>'Norfolk Islands (+672)',
			self::COUNTRY_N2 =>'Northern Marianas (+670)',
			self::COUNTRY_NO =>'Norway (+47)',
			self::COUNTRY_OM =>'Oman (+968)',
			self::COUNTRY_PW =>'Palau (+680)',
			self::COUNTRY_PA =>'Panama (+507)',
			self::COUNTRY_PG =>'Papua New Guinea (+675)',
			self::COUNTRY_PY =>'Paraguay (+595)',
			self::COUNTRY_PE =>'Peru (+51)',
			self::COUNTRY_PH =>'Philippines (+63)',
			self::COUNTRY_PL =>'Poland (+48)',
			self::COUNTRY_PT =>'Portugal (+351)',
			self::COUNTRY_PR =>'Puerto Rico (+1787)',
			self::COUNTRY_QA =>'Qatar (+974)',
			self::COUNTRY_RE =>'Reunion (+262)',
			self::COUNTRY_RO =>'Romania (+40)',
			self::COUNTRY_RU =>'Russia (+7)',
			self::COUNTRY_RW =>'Rwanda (+250)',
			self::COUNTRY_SM =>'San Marino (+378)',
			self::COUNTRY_ST =>'Sao Tome & Principe (+239)',
			self::COUNTRY_SA =>'Saudi Arabia (+966)',
			self::COUNTRY_SN =>'Senegal (+221)',
			self::COUNTRY_SB =>'Serbia (+381)',
			self::COUNTRY_S3 =>'Seychelles (+248)',
			self::COUNTRY_SL =>'Sierra Leone (+232)',
			self::COUNTRY_SG =>'Singapore (+65)',
			self::COUNTRY_SK =>'Slovak Republic (+421)',
			self::COUNTRY_S1 =>'Slovenia (+386)',
			self::COUNTRY_SI =>'Solomon Islands (+677)',
			self::COUNTRY_SO =>'Somalia (+252)',
			self::COUNTRY_ZA =>'South Africa (+27)',
			self::COUNTRY_ES =>'Spain (+34)',
			self::COUNTRY_LK =>'Sri Lanka (+94)',
			self::COUNTRY_SH =>'St. Helena (+290)',
			self::COUNTRY_KN =>'St. Kitts (+1869)',
			self::COUNTRY_S4 =>'St. Lucia (+1758)',
			self::COUNTRY_SD =>'Sudan (+249)',
			self::COUNTRY_SR =>'Suriname (+597)',
			self::COUNTRY_SZ =>'Swaziland (+268)',
			self::COUNTRY_SE =>'Sweden (+46)',
			self::COUNTRY_CH =>'Switzerland (+41)',
			self::COUNTRY_S2 =>'Syria (+963)',
			self::COUNTRY_TW =>'Taiwan (+886)',
			self::COUNTRY_TJ =>'Tajikstan (+7)',
			self::COUNTRY_TH =>'Thailand (+66)',
			self::COUNTRY_TG =>'Togo (+228)',
			self::COUNTRY_TO =>'Tonga (+676)',
			self::COUNTRY_TT =>'Trinidad & Tobago (+1868)',
			self::COUNTRY_TN =>'Tunisia (+216)',
			self::COUNTRY_TR =>'Turkey (+90)',
			self::COUNTRY_T1 =>'Turkmenistan (+7)',
			self::COUNTRY_T2 =>'Turkmenistan (+993)',
			self::COUNTRY_TC =>'Turks & Caicos Islands (+1649)',
			self::COUNTRY_TV =>'Tuvalu (+688)',
			self::COUNTRY_UG =>'Uganda (+256)',
			self::COUNTRY_GB =>'UK (+44)',
			self::COUNTRY_UA =>'Ukraine (+380)',
			self::COUNTRY_AE =>'United Arab Emirates (+971)',
			self::COUNTRY_UY =>'Uruguay (+598)',
			self::COUNTRY_US =>'USA (+1)',
			self::COUNTRY_UZ =>'Uzbekistan (+7)',
			self::COUNTRY_VU =>'Vanuatu (+678)',
			self::COUNTRY_VA =>'Vatican City (+379)',
			self::COUNTRY_VE =>'Venezuela (+58)',
			self::COUNTRY_VN =>'Vietnam (+84)',
			self::COUNTRY_VG =>'Virgin Islands - British (+1284)',
			self::COUNTRY_VI =>'Virgin Islands - US (+1340)',
			self::COUNTRY_WF =>'Wallis & Futuna (+681)',
			self::COUNTRY_YN =>'Yemen (North)(+969)',
			self::COUNTRY_YS =>'Yemen (South)(+967)',
			self::COUNTRY_ZM =>'Zambia (+260)',
			self::COUNTRY_ZW =>'Zimbabwe (+263)',
		);
	}
}