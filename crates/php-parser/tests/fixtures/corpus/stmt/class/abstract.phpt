===source===
<?php

abstract class A {
    public function a() {}
    abstract public function b();
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 22,
              "end": 23
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
                    "name": "a",
                    "span": {
                      "start": 46,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 52
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 82,
                      "end": 83
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 57,
                "end": 86
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 16,
        "end": 88
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 88
  }
}
