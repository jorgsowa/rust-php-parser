===source===
<?php abstract class Foo { abstract public function bar(): string { return ''; } }
===errors===
Abstract function Foo::bar() cannot contain body
===php_error===
PHP Fatal error:  Abstract function Foo::bar() cannot contain body in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 21,
              "end": 24
            }
          },
          "modifiers": {
            "is_abstract": true,
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
                      "start": 52,
                      "end": 55
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 59,
                          "end": 65
                        }
                      }
                    },
                    "span": {
                      "start": 59,
                      "end": 65
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "String": ""
                          },
                          "span": {
                            "start": 75,
                            "end": 77
                          }
                        }
                      },
                      "span": {
                        "start": 68,
                        "end": 78
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 27,
                "end": 80
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 82
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 82
  }
}
