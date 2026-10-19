===source===
<?php class Foo {
    function clone() {}
    function match() {}
    function fn() {}
}
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
                    "name": "clone",
                    "span": {
                      "start": 31,
                      "end": 36
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 41
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "match",
                    "span": {
                      "start": 55,
                      "end": 60
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 46,
                "end": 65
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "fn",
                    "span": {
                      "start": 79,
                      "end": 81
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 70,
                "end": 86
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 88
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 88
  }
}
