
			KindEditor.ready(function(K) {
				var editor = K.editor({
					allowFileManager : true
				});
				K('#upload-tip').click(function() {
					editor.loadPlugin('multiimage', function() {
						editor.plugin.multiImageDialog({
							clickFn : function(urlList) {
								var textareaContain = $("#textContain textarea").eq(0);
								K.each(urlList, function(i, data) {
									data.url=data.url.replace('/upload','upload'); 
									var addString = baseurl + data.url +'\n';
									textareaContain.val(textareaContain.val()+addString);
								});
								editor.hideDialog();
							}
						});
					});
				});
//				//≤Â»Î¥˙¬Î
//				K('#insert_code').click(function() {
//					editor.loadPlugin('code', function() {
//						editor.plugin.codeDialog({
//							clickFn : function(body) {
//									var textareaContain = $("#textContain textarea").eq(0);
//									var addString = body+'\n';
//									textareaContain.val(textareaContain.val()+addString);
//								editor.hideDialog();
//							}
//						});
//					});
//				});
				
			});