/* German initialisation for the jQuery UI date picker plugin. */
/* Written by Milian Wolff (mail@milianw.de). */
 
$.datepicker.regional['de'] = {
    closeText: 'schließen',
    prevText: '&#x3c;zurück',
    nextText: 'Vor&#x3e;',
    currentText: 'heute',
    monthNames: ['1月','2月','3月','4月','5月','6月',
    '7月','8月','9月','10月','11月','12月'],
    monthNamesShort: ['1月','2月','3月','4月','5月','6月',
    '7月','8月','9月','10月','11月','12月'],
    dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
    dayNamesShort: ['周一','周二','周三','周四','周五','周六','周日'],
    dayNamesMin: ['周一','周二','周三','周四','周五','周六','周日'],
    weekHeader: 'Wo',
    dateFormat: 'dd.mm.yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''};
 
$.timepicker.regional['de'] = {
    timeOnlyTitle: 'Zeit wählen',
    timeText: 'Zeit',
    hourText: 'Stunde',
    minuteText: 'Minute',
    secondText: 'Sekunde',
    currentText: 'Aktuelle Zeit',
    closeText: 'Schließen',
    ampm: false
};
 
$.datepicker.setDefaults($.datepicker.regional['de']);
$.timepicker.setDefaults($.timepicker.regional['de']);