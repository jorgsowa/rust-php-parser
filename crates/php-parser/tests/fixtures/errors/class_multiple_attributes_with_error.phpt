===source===
<?php
class Foo {
    #[Route('/')]
    #[Cache]
    @invalid
    public function bar() { return 1; }

    #[Validate]
    public function baz() { return 2; }
}
===errors <=7.4===
'attributes' requires PHP 8.0 or higher
'attributes' requires PHP 8.0 or higher
expected class member, found '@'
'attributes' requires PHP 8.0 or higher
===errors >=8.0===
expected class member, found '@'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '@', expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 5
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" or "const" in Standard input code on line 5
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token "@", expecting "function" in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                    "name": "bar",
                    "span": {
                      "start": 82,
                      "end": 85
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 97,
                            "end": 98
                          }
                        }
                      },
                      "span": {
                        "start": 90,
                        "end": 99
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 66,
                "end": 101
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "baz",
                    "span": {
                      "start": 139,
                      "end": 142
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 154,
                            "end": 155
                          }
                        }
                      },
                      "span": {
                        "start": 147,
                        "end": 156
                      }
                    }
                  ],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Validate"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 109,
                          "end": 117
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 109,
                        "end": 117
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 107,
                "end": 158
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 160
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 160
  }
}
