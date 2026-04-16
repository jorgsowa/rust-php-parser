===source===
<?php use;
===errors===
expected identifier, found ';'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "<error>"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 9,
                  "end": 10
                }
              },
              "alias": null,
              "span": {
                "start": 9,
                "end": 9
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 10
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 10
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 1
