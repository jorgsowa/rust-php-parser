===source===
<?php
enum E implements self {}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Cannot use "self" as interface name, as it is reserved
===errors >=8.1===
Cannot use "self" as interface name, as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1-8.3===
PHP Fatal error:  Cannot use 'self' as interface name, as it is reserved in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "self" as interface name, as it is reserved in Standard input code on line 2
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
          "scalar_type": null,
          "implements": [
            {
              "parts": [
                "self"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 24,
                "end": 28
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
