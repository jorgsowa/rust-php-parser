===source===
<?php
enum parent {}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Cannot use "parent" as an enum name as it is reserved
===errors >=8.1===
Cannot use "parent" as an enum name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'parent' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "parent" in Standard input code on line 2
===php_error 8.1-8.3===
PHP Fatal error:  Cannot use 'parent' as class name as it is reserved in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "parent" as an enum name as it is reserved in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "parent",
            "span": {
              "start": 11,
              "end": 17
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
