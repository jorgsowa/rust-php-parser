===source===
<?php
enum Never {}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
===errors >=8.1===
Cannot use "Never" as an enum name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Never' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Never" in Standard input code on line 2
===php_error 8.1-8.3===
PHP Fatal error:  Cannot use 'Never' as class name as it is reserved in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "Never" as an enum name as it is reserved in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "Never",
            "span": {
              "start": 11,
              "end": 16
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
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
