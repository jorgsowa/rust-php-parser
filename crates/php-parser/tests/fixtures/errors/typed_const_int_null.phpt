===source===
<?php
class A { const int X = null; }
===errors <=8.2===
'typed class constants' requires PHP 8.3 or higher
Cannot use null as value for class constant A::X of type int
===errors >=8.3===
Cannot use null as value for class constant A::X of type int
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'X' (T_STRING), expecting '=' in Standard input code on line 2
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected identifier "X", expecting "=" in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use null as value for class constant A::X of type int in Standard input code on line 2
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
                    "name": "X",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 25
                        }
                      }
                    },
                    "span": {
                      "start": 22,
                      "end": 25
                    }
                  },
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 30,
                      "end": 34
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 35
              }
            }
          ],
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
