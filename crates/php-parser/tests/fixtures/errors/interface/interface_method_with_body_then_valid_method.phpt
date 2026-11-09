===source===
<?php interface Foo { public function bar() { return 1; } public function baz(); }
===errors===
Interface function Foo::bar() cannot contain body
===php_error===
PHP Fatal error:  Interface function Foo::bar() cannot contain body in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 16,
              "end": 19
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "bar",
                    "span": {
                      "start": 38,
                      "end": 41
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
                            "start": 53,
                            "end": 54
                          }
                        }
                      },
                      "span": {
                        "start": 46,
                        "end": 55
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 57
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "baz",
                    "span": {
                      "start": 74,
                      "end": 77
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 58,
                "end": 80
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 82
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 82
  }
}
