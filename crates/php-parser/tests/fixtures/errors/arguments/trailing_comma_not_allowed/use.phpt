===source===
<?php
use A, ;
===errors===
expected name, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting identifier (T_STRING) or \\ (T_NS_SEPARATOR) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting identifier or fully qualified name or namespaced name in Standard input code on line 2
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
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
