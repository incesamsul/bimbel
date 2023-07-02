<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - katex implementation</title>
    <link rel="stylesheet" href="./style.css">

</head>

<body>

    <input type="hidden" id="input" value="{{ $latex }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.10.2/dist/katex.min.css"
        integrity="sha384-yFRtMMDnQtDRO8rLpMIKrtPCD5jdktao2TV19YiZYWMDkUR5GQZR/NOVTdquEx1j" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.10.2/dist/katex.min.js"
        integrity="sha384-9Nhn55MVVN0/4OFx7EE5kpFBPsEMZxKTCnA+4fqDmg12eCTqGi6+BB2LjY8brQxJ" crossorigin="anonymous">
    </script>
    <script type="module" type="text/javascript">
        const math = document.getElementById("math");
        const input = document.getElementById("input").value;
        generate(input);
        function generate(latex) {
          katex.render(String.raw`${latex}`, math, {
            throwOnError: false
          });
        }
      </script>


    <div id="math"></div>
    <!-- partial -->

</body>

</html>
