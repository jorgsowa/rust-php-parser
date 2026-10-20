===source===
<?php
class A {
    readonly const X = 1;
}
===errors <=8.0===
'readonly properties' requires PHP 8.1 or higher
cannot use 'readonly' as constant modifier
===errors >=8.1===
cannot use 'readonly' as constant modifier
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'readonly' (T_STRING), expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly", expecting "function" or "const" in Standard input code on line 3
===php_error 8.1-8.2===
PHP Fatal error:  Cannot use 'readonly' as constant modifier in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Cannot use the readonly modifier on a class constant in Standard input code on line 3
===ast >=7.4===
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
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 35,
                      "end": 36
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 41
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
