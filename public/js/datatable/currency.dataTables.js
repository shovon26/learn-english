jQuery.extend(jQuery.fn.dataTableExt.oSort, {
	"currency-comma-pre": function (a) {
		//if(a.charAt(0) === '€')
		if(currencyHtmlCode === '€' || currencyHtmlCode === '₫' || currencyHtmlCode === 'Rp')
		{
			a = (a === "-") ? 0 : a.replace(/[^\d\-\,]/g, "");
		}
		else
		{
			a = (a === "-") ? 0 : a.replace(/[^\d\-\.]/g, "");
		}
		return parseFloat(a);
	},
	"currency-comma-asc": function (a, b) {
		return a - b;
	},
	"currency-comma-desc": function (a, b) {
		return b - a;
	}
});