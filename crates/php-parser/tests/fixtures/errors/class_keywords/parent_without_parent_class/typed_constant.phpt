===source===
<?php
class A {
    const parent C = 1;
}
===errors <=7.4===
'typed class constants' requires PHP 8.3 or higher
Cannot use int as value for class constant A::C of type parent
===errors 8.0-8.2===
'typed class constants' requires PHP 8.3 or higher
Cannot use int as value for class constant A::C of type parent
Cannot use "parent" when current class scope has no parent
===errors >=8.3===
Cannot use int as value for class constant A::C of type parent
Cannot use "parent" when current class scope has no parent
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'C' (T_STRING), expecting '=' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected identifier "C", expecting "=" in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 3
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
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 33,
                      "end": 34
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 26,
                          "end": 32
                        }
                      }
                    },
                    "span": {
                      "start": 26,
                      "end": 32
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 37,
                      "end": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 39
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
