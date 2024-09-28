$(document).ready(function () {
    var delayTimer;

    $("#search-input").on("keyup", function () {
        clearTimeout(delayTimer);

        var searchTerm = $(this).val();

        console.log(searchTerm);

        if (searchTerm === "") {
            $("#no-results").empty();
        }

        delayTimer = setTimeout(function () {
            $.ajax({
                url: "search",
                type: "GET",
                data: { search: searchTerm },
                success: function (data) {
                    $("#search-results").empty();
                    $("#no-results").empty();

                    if (data.results.length > 0) {
                        data.results.forEach(function (result) {
                            var truncatedName =
                                result.name.length > 40
                                    ? result.name.substring(0, 40) + "..."
                                    : result.name;

                            var resultDiv = $(
                                '<div class="grid bg-gray-100 rounded-[10px] border-[1px]">' +
                                    '<form action="/show-details_product" method="GET">' +
                                    '<input type="hidden" name="idProduct" value="' +
                                    result.id +
                                    '">' +
                                    '<div class="flex items-center justify-center pt-[20px]">' +
                                    '<img src="' +
                                    result.image +
                                    '" alt="" class="h-[250px] rounded-[10px]">' +
                                    "</div>" +
                                    '<div class="px-[30px] pb-[30px] flex items-center justify-between py-[20px]">' +
                                    '<button type="submit" class="text-left font-medium w-[150px]">' +
                                    truncatedName +
                                    "</button>" +
                                    '<div class="grid items-center gap-[10px]">' +
                                    '<p class="text-gray-500 text-right font-semibold">' +
                                    result.price +
                                    "₫</p>" +
                                    '<button type="submit" class="font-medium text-blue-500 bg-blue-100 p-[10px] rounded-[5px]">Xem thêm</button>' +
                                    "</div>" +
                                    "</div>" +
                                    "</form>" +
                                    "</div>"
                            );

                            $("#search-results").append(resultDiv);
                        });
                    } else {
                        var resultDiv = $(
                            '<div class="py-[50px] text-center w-full">' +
                                "<p>Không có sản phẩm nào được tìm thấy</p>" +
                                "</div>"
                        );

                        $("#no-results").append(resultDiv);
                    }
                },
                error: function (error) {
                    console.error("Error:", error);
                },
            });
        }, 0);
    });
});
