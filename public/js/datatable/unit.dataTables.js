jQuery.extend(jQuery.fn.dataTableExt.oSort, {
	"unit-comma-pre": function (a) {
		a = (a === "") ? 0 : a.replace(/[^\d\-\.]/g, "");
		return parseFloat(a);
	},
	"unit-comma-asc": function (a, b) {
		return a - b;
	},
	"unit-comma-desc": function (a, b) {
		return b - a;
	}
});