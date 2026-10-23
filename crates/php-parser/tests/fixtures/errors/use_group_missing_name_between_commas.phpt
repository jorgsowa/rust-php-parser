===source===
<?php use A\{B, , C};
===errors===
expected identifier, found ','
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',', expecting '}' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ",", expecting "}" in Standard input code on line 1
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
                  "A",
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 14
                }
              },
              "alias": null,
              "span": {
                "start": 13,
                "end": 14
              }
            },
            {
              "name": {
                "parts": [],
                "kind": "Error",
                "span": {
                  "start": 15,
                  "end": 15
                }
              },
              "alias": null,
              "span": {
                "start": 15,
                "end": 15
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "C"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 19
                }
              },
              "alias": null,
              "span": {
                "start": 18,
                "end": 19
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
