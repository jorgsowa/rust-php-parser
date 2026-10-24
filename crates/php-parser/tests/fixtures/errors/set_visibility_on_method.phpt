===source===
<?php
class A {
    private(set) function f() {}
}
===errors <=8.3===
'asymmetric visibility' requires PHP 8.4 or higher
Cannot use the private(set) modifier on a method
===errors >=8.4===
Cannot use the private(set) modifier on a method
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(', expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(", expecting variable in Standard input code on line 3
===php_error 8.2-8.3===
PHP Parse error:  syntax error, unexpected token ")", expecting amp in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot use the private(set) modifier on a method in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 42,
                      "end": 43
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 48
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
