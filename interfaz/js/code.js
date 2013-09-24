$(document).ready(function() {
	$("#TableLinks").tablesorter(); 

	$( "#Links" ).sortable({
      distance: 15
    });
    $( "#Links" ).disableSelection();
$.ajax({
			type : 'POST',
			url : 'sesionIniciada.php',
			success : function(response) {
				if (response == true) {//si hay sesion
					window.location = ("#p_main");
					fLogin();
				}
}});

	$('#B_LoginShare').click(function() {
		$.ajax({
			type : 'POST',
			url : 'login.php',
			data : $('#loginShare').serialize(),
			success : function(result) {
				if (result == 1) {
					fLogin;
					window.location = ("#p_main");
				} else {
					alert("Unidentified User" + result);
					location.reload(true);

				}

			}
		});

	});
	$('#register').click(function(){
			$.ajax({
				type:'POST', 
				url: 'registro.php', 
				data:$('#registro').serialize(),
				success: function(response) {  
					if(response==1){
						window.location = ("#p_main");
					}
					else
						alert(response);
	
				}
			});
			
	
	   });
	   
	   function fLogin() {
			$.ajax({
				url : 'lists.php',
				type : 'post',
				dataType : 'html',
				cache : false,
				//cuando la llamada del ajax devuelve algo, llega a success, y el succes llama a la funcion obtengoListas
				success : obtengoListas
			});
		}
		function obtengoListas(html) {
			// create DOM elements in a jQuery object
			function cambiaOnClickListas() {
				this.cambia = function cambia(donde) {
					donde.innerHTML = html;
					var vector = document.getElementsByClassName('list');
					for (var i = 0; i < vector.length; i++) {
						vector[i].onclick = this.muestraLinks;
						//		            	alert(vector[i].onclick);
					}
					//    $('#lista').listview("refresh");
				};
				this.muestraLinks = function muestraLinks() {
					var param = 'id=' + this.name;
					document.f1.campo1.value = "http://gramolapro.com/index.html?v=" + this.name;
					crearPlayList(this.name);
					
					$.ajax({
						url : 'links.php',
						type : 'post',
						dataType : 'html',
						data : param,
						cache : false,
						success : obtengoLinks
					});

				};
				
			}	
			var objeto2 = new cambiaOnClickListas();
			objeto2.cambia(document.getElementById("d_listContainer"));
		}
		function obtengoLinks(html2) {
			//$html.filter('.list').appendTo("#nameList");
			//$('#Links').find('#nameLinks').html(html);
			function cambiaOnClickLinks() {
				this.change = function change(where) {
					where.innerHTML = "";
					$('#TableLinks').append(html2);
					var vector = document.getElementsByClassName('link');
					for (var i = 0; i < vector.length; i++) {
						vector[i].onclick = playOnlyOne;
						/////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
						//playlist.addSong(new Song(vector[i].name, null));
						//añado todas las canciones una a una en la playList, se encarga el propio metodo por dentro de añadirle a cada cancion el id de la lista a la que pertenece
						/////////////////////////////////////////////////////////////////////////////////////////////////////////////////7
					}
					//alert(playList.getNumberSongs());
					var vector3 = document.getElementsByClassName('buttonDelLink');
					for (var i = 0; i < vector3.length; i++) {
						vector3[i].onclick = deleteLink;
					}

					var vectorList = document.getElementsByClassName('buttonBList');
					for (var i = 0; i < vectorList.length; i++) {
						vectorList[i].onclick = deleteList;
					}

					var vectorVList = document.getElementsByClassName('buttonVList');
					for (var i = 0; i < vectorVList.length; i++) {
						vectorVList[i].onclick = voteList;
					}

					var vectorVotes = document.getElementsByClassName('buttonOfVotes');
					for (var i = 0; i < vectorVotes.length; i++) {
						vectorVotes[i].onclick = setVote;

					}

					var vector2 = document.getElementsByClassName('linkIcon');
					//alert(vector2.length);
					//$('#providerTabla').text("adios");

					for (var j = 0; j < vector2.length; j++) {
						//alert(vector2[j].innerText);
						if (vector2[j].innerText == 'youtube') {
							vector2[j].innerHTML = '<image style="width=60px height=60" src="./images/youtube.png">';
							(playlist.getElement(j)).setProvider(PROVIDER.YOUTUBE);
						}
						if (vector2[j].innerText == 'goear') {
							vector2[j].innerHTML = '<image style="width=60px height=60px" src="./images/goear.png">';
							playlist.getElement(j).setProvider(PROVIDER.GOEAR);
						}
						if (vector2[j].innerText == 'spotify') {
							vector2[j].innerHTML = '<image style="width=50px height=50px" src="./images/spotify.png">';
							playlist.getElement(j).setProvider("spotify");
						}
						if (vector2[j].innerText == 'mp3') {
							vector2[j].innerHTML = '<image style="width=50px height=40px" src="./images/music.png">';
							playlist.getElement(j).setProvider(PROVIDER.MP3);
						}

					}
					$("#TableLinks").tablesorter(); 
				};
				//cuando pulsa un link llama a esta funcion, el caso es saber que poscion en la lista tiene esta cancion
				//Permisos
				$.ajax({
					url : 'getRights.php',
					type : 'post',
					dataType : 'html',
					cache : false,
					success : function(response) {

						if (response == "N") {

							$('#tablaComp').hide();
							$('#f1').hide();
							$('#textLink').hide();
							$('.qrButton').hide();
							$('#messagePrivate').fadeIn();
							//$('#messagePrivate').style="block";

						} else {
							$('#tablaComp').fadeIn();
							$('#f1').fadeIn();
							$('#textLink').fadeIn();
							$('.qrButton').fadeIn();
							$('#messagePrivate').hide();

						}
					}
				});
				
			}

			var objetoLinks = new cambiaOnClickLinks();
			objetoLinks.change(document.getElementById("Links"));

		}
	function playOnlyOne(){
		playOnClick(playlist.searchIdSong(this.name));
		//guardo que posicion de la tabla es la que he pulsado
		playlist.getPositionID(this.name);
	}
	//la idea es llamar a este método cada vez que se mueva un elemento de la tabla o lo que sea
	function crearPlayList(idList){
	placePlayer();
		//que cuando se pulse el boton o lo que sea se genere la playlist
		playlist = new Playlist(this.name);
		//primero un bucle, va a recorrer toda la tabla
		//genera un elemento song, que lo añade a la playlist
		var vector = document.getElementsByClassName('link');
		for (var i = 0; i < vector.length; i++) {
			playlist.addSong(new Song(vector[i].name, null));
		}
		alert(vector[0]);
	}
	//para reproducir, como se que posicion actual es la de la lista, solo tendria que recorrer toda la tabla y buscar la poscion actual+1
	
});
$( "#popupPanelLeft" ).on({
    popupbeforeposition: function() {
        var h = $( window ).height();

        $( "#popupPanelLeft" ).css( "height", h );
    }
});
$( "#popupPanelRight" ).on({
    popupbeforeposition: function() {
        var h = $( window ).height();

        $( "#popupPanelRight" ).css( "height", h );
    }
});
function placePlayer() {
		$('#tabs2-4').append(stopButton);
		$('#tabs2-4').append(nextSongButton);
		$('#tabs2-4').append(playButton);
	}