const appPath = 'http://localhost/repos/easylms/'; 
const themePath = `${appPath}themes/dore/assets/`;
const logoutPath = 'login/login_actions/logout';
const updatePath = 'login/login_actions/update_session';
const applicationServerPublicKey = 'BBpQAy6d2Q1LKgwAqLU96oHM1Ugyvyq8eDiPlyptO40juyjFQV9wgC6Sem2VcjmuFKY081z30DwLYpz3kF9YA8A';
const sidebarSection = document.getElementById("sidebar");
const mainSection = document.getElementById("content");
const outputDiv = document.getElementById("response"); 
const loader = document.getElementById("loader");
const notifyButton = document.querySelector('.enable-notification');

let isSubscribed = false;
let swRegistration = null;

var rootStyle = getComputedStyle(document.body);
var themeColor1 = rootStyle.getPropertyValue("--theme-color-1").trim();
var themeColor2 = rootStyle.getPropertyValue("--theme-color-2").trim();
var themeColor3 = rootStyle.getPropertyValue("--theme-color-3").trim();
var themeColor4 = rootStyle.getPropertyValue("--theme-color-4").trim();
var themeColor5 = rootStyle.getPropertyValue("--theme-color-5").trim();
var themeColor6 = rootStyle.getPropertyValue("--theme-color-6").trim();
var themeColor1_10 = rootStyle.getPropertyValue("--theme-color-1-10").trim();
var themeColor2_10 = rootStyle.getPropertyValue("--theme-color-2-10").trim();
var themeColor3_10 = rootStyle.getPropertyValue("--theme-color-3-10").trim();
var themeColor4_10 = rootStyle.getPropertyValue("--theme-color-4-10").trim();
var themeColor5_10 = rootStyle.getPropertyValue("--theme-color-5-10").trim();
var themeColor6_10 = rootStyle.getPropertyValue("--theme-color-6-10").trim();
var primaryColor = rootStyle.getPropertyValue("--primary-color").trim();
var foregroundColor = rootStyle.getPropertyValue("--foreground-color").trim();
var separatorColor = rootStyle.getPropertyValue("--separator-color").trim();

var chartTooltip = {
	backgroundColor: "white",
	titleFontColor: primaryColor,
	borderColor: separatorColor,
	borderWidth: 0.5,
	bodyFontColor: primaryColor,
	bodySpacing: 10,
	xPadding: 15,
	yPadding: 15,
	cornerRadius: 0.15,
	displayColors: false
};
