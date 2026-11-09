===source===
<?php
class A {
    function __wakeup(): static {}
}
===errors <=7.4===
'static type' requires PHP 8.0 or higher
===errors >=8.0===
A::__wakeup(): Return type must be void when declared
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC) in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  A::__wakeup(): Return type must be void when declared in Standard input code on line 3
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
                    "name": "__wakeup",
                    "span": {
                      "start": 29,
                      "end": 37
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "static"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 41,
                          "end": 47
                        }
                      }
                    },
                    "span": {
                      "start": 41,
                      "end": 47
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 50
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
