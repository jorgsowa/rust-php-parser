===source===
<?php
enum C { case X = "a" . "b"; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Case X of non-backed enum C must not have a value
===errors >=8.1===
Case X of non-backed enum C must not have a value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'C' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "C" in Standard input code on line 2
===php_error 8.1===
PHP Fatal error:  Case X of non-backed enum C must not have a value, try adding ": string" to the enum declaration in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Case X of non-backed enum C must not have a value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "C",
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
                "Case": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 20,
                      "end": 21
                    }
                  },
                  "value": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 24,
                            "end": 27
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "String": "b"
                          },
                          "span": {
                            "start": 30,
                            "end": 33
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 24,
                      "end": 33
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 15,
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
