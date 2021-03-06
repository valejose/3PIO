function betterTab(cm) {
  if (cm.somethingSelected()) {
    cm.indentSelection("add");
  } else {
    cm.replaceSelection(cm.getOption("indentWithTabs")? "\t":
												Array(cm.getOption("indentUnit") + 1).join(" "),
												"end", "+input");
  }
}

var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
  mode: {name: "python",
         version: 2,
         singleLineStringErrors: false},
  lineNumbers: true,
  indentUnit: 4,
  matchBrackets: true,
	//theme: "solarized dark"
	theme: "default",
	extraKeys: { Tab: betterTab }
});

document.getElementById("runButton").onclick = function() { clearAlerts(); run(); };

/*
uncomment to disable copy/paste for projects
editor.on('copy', function(a, e) {e.preventDefault();});
editor.on('cut', function(a, e) {e.preventDefault();});
editor.on('paste', function(a, e) {e.preventDefault();});
*/

// function outf(text) { 
// 	if (text && typeof(text) != "undefined") {
// 		text = text.replace("<", "&lt;").replace(">", "&gt;");
// 		console.log(text);
// 		var mypre = document.getElementById("output"); 
// 		console.log(mypre);
// 		mypre.innerHTML = mypre.innerHTML + text;
// 	}
// } 
// function inf(prompt) {
// 	// Must copy the prompt string for some reason
//   return window.prompt(String(prompt));
// }
function builtinRead(x) {
    if (Sk.builtinFiles === undefined || Sk.builtinFiles["files"][x] === undefined)
            throw "File not found: '" + x + "'";
    return Sk.builtinFiles["files"][x];
}

function run() {
	var program = editor.getValue() + '\n';
	var outputArea = document.getElementById("output");
	outputArea.innerHTML = '';
	Sk.pre = "output";
  //Sk.configure({output:outf, read:builtinRead});
	Sk.configure({
		output:outf, read:builtinRead,
		inputfun:inf,
    // inputfun: function (prompt) {
    //   return window.prompt(prompt);
    // },
    inputfunTakesPrompt:true,
    // output: function(str) {
    //   //strip out line-feeds
    //   if (str.replace(/\n/g, "") !== "") {
    //     repl.print(str);
    //   }
    // },
    // read: function (x) {
    //   if (Sk.builtinFiles === undefined || Sk.builtinFiles["files"][x] === undefined) {
    //     throw "File not found: '" + x + "'";
    //   }
    //   return Sk.builtinFiles["files"][x];
    // },
		// retainglobals: true
	});
	(Sk.TurtleGraphics || (Sk.TurtleGraphics = {})).target = 'mycanvas';
  var myPromise = Sk.misceval.asyncToPromise(function() {
    return Sk.importMainWithBody("<stdin>", false, program, true);
  });
  myPromise.then(function(mod) {},
								 function(err) {
									 markError(err.toString());
								 });
}
var codeAlerts = document.getElementById('codeAlerts');

function clearAlerts()
{
	codeAlerts.innerHTML = '';
}

function markError(errorMessage)
{
	codeAlerts.innerHTML += '<div class="alert alert-danger alert-dismissible mar-0" role="alert" id="infoAlert">' + errorMessage + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}

function markSuccess(successMessage)
{
	codeAlerts.innerHTML += '<div class="alert alert-success alert-dismissible mar-0" role="alert" id="infoAlert">' + successMessage + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}

