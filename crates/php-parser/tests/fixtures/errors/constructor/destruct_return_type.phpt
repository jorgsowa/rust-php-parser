===source===
<?php
class A {
    public function __destruct(): void {}
}
interface I {
    public function __DESTRUCT(): int;
}
===errors <=7.4===
Destructor A::__destruct() cannot declare a return type
===errors >=8.0===
Method A::__destruct() cannot declare a return type
Method I::__DESTRUCT() cannot declare a return type
===php_error <=7.4===
PHP Fatal error:  Destructor A::__destruct() cannot declare a return type in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Method A::__destruct() cannot declare a return type in Standard input code on line 3
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
                    "name": "__destruct",
                    "span": {
                      "start": 36,
                      "end": 46
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
                          "start": 50,
                          "end": 54
                        }
                      }
                    },
                    "span": {
                      "start": 50,
                      "end": 54
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 57
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 59
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 70,
              "end": 71
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__DESTRUCT",
                    "span": {
                      "start": 94,
                      "end": 104
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
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 108,
                          "end": 111
                        }
                      }
                    },
                    "span": {
                      "start": 108,
                      "end": 111
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 78,
                "end": 112
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 60,
        "end": 114
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 114
  }
}
