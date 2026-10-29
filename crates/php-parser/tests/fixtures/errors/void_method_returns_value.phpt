===source===
<?php
class A {
    public function f(): void {
        return 1;
    }
}
===errors===
A void method must not return a value
===php_error <=8.3===
PHP Fatal error:  A void function must not return a value in Standard input code on line 4
===php_error >=8.4===
PHP Fatal error:  A void method must not return a value in Standard input code on line 4
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
                      "start": 36,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 41,
                          "end": 45
                        }
                      }
                    },
                    "span": {
                      "start": 41,
                      "end": 45
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 63,
                            "end": 64
                          }
                        }
                      },
                      "span": {
                        "start": 56,
                        "end": 65
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 71
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
