===source===
<?php use A, , B;
===errors===
expected identifier, found ','
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',', expecting identifier (T_STRING) or \\ (T_NS_SEPARATOR) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ",", expecting identifier or fully qualified name or namespaced name in Standard input code on line 1
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
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 11
              }
            },
            {
              "name": {
                "parts": [],
                "kind": "Error",
                "span": {
                  "start": 13,
                  "end": 14
                }
              },
              "alias": null,
              "span": {
                "start": 13,
                "end": 13
              }
            },
            {
              "name": {
                "parts": [
                  "B"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 15,
                  "end": 16
                }
              },
              "alias": null,
              "span": {
                "start": 15,
                "end": 16
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
