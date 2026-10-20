===source===
<?php
class A { const int X = 'a'; }
===errors >=8.5===
Cannot use string as value for class constant A::X of type int
===php_error <=8.2===
PHP Parse error:  syntax error, unexpected identifier "X", expecting "=" in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use string as value for class constant A::X of type int in Standard input code on line 2
===ast >=8.5===
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
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 30,
                      "end": 33
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 34
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
