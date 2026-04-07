===source===
<?php abstract class Foo { abstract public function bar(): string { return ''; } }
===errors===
abstract method cannot contain a body
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "bar",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
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
                        "end": 79
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 27,
                "end": 81
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
