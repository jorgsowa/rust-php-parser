===source===
<?php
enum E: \INT {}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Type declaration 'int' must be unqualified
===errors >=8.1===
Type declaration 'int' must be unqualified
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Type declaration 'int' must be unqualified in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": {
            "parts": [
              "INT"
            ],
            "kind": "FullyQualified",
            "span": {
              "start": 14,
              "end": 18
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
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
