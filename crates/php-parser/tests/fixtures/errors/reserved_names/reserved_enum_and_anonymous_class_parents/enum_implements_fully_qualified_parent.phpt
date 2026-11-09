===source===
<?php
enum F implements I, \parent {}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
'\parent' is an invalid class name
===errors >=8.1===
'\parent' is an invalid class name
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'F' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "F" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  '\parent' is an invalid class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "F",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "implements": [
            {
              "parts": [
                "I"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 24,
                "end": 25
              }
            },
            {
              "parts": [
                "parent"
              ],
              "kind": "FullyQualified",
              "span": {
                "start": 27,
                "end": 34
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
