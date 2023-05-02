$(document).ready(function () {
  $("#product_form").submit(function (event) {
    event.preventDefault();

    var product = $("#product_form").serializeArray();
    var type;
    var measurement;
    var attribute;

    product.some(function (field) {
      if (field.name === "type") {
        type = field.value;
        return true;
      }
    });

    if (arr[type]) {
      measurement = arr[type].measurement;
      attribute = arr[type].attribute;

      // Add measurement to the product associative array
      product.push(
        {
          name: "measurement",
          value: measurement,
        },
        {
          name: "attribute",
          value: attribute,
        }
      );
    }

    $.ajax({
      url: "product",
      type: "POST",
      data: product,
      dataType: "json",
      success: function (response) {
        if (response.success) {
          // success

          // Redirect to the index.php page
          var baseUrl = window.location.protocol + "//" + window.location.host;
          var indexUrl = baseUrl + "/";
          window.location.href = indexUrl;
        } 
      },
      error: function (response) {
        // handle error
        $("#error").text(response.responseJSON.message);
    }
    });
  });
});

//------------------- type selector

$(function () {
  const productType = $("#productType");
  const typeBox = $(".type-box");

  productType.on("change", function () {
    const selectedType = productType.val();
    const typeObj = arr[selectedType];

    const inputTypes = [].concat(typeObj.type);
    const descriptionHtml = `<span>${typeObj.description}</span>`;
    const typeInputHtml = inputTypes
      .map(
        (type) => `
              <div class="form-input">
                <label for="${type}">${type} (${typeObj.measurement})</label>
                <input type="text" name="${type.toLowerCase()}" id="${type.toLowerCase()}">
              </div>
            `
      )
      .join("");

    const fullInputHtml = typeInputHtml + descriptionHtml;
    typeBox.html(fullInputHtml);
  });
});
