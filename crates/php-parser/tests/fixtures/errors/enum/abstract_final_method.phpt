===source===
<?php
enum E {
    abstract final function f();
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Cannot use the final modifier on an abstract method
Enum method E::f() must not be abstract
===errors >=8.1===
Cannot use the final modifier on an abstract method
Enum method E::f() must not be abstract
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error 8.1-8.2===
PHP Fatal error:  Cannot use the final modifier on an abstract class member in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Cannot use the final modifier on an abstract method in Standard input code on line 3
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
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 43,
                      "end": 44
                    }
                  },
                  "modifiers": {
                    "is_abstract": true,
                    "is_final": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 19,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
