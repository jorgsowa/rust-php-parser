===source===
<?php class Foo extends Bar { public function bar(): parent {} }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "Bar"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 24,
              "end": 27
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "bar",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 53,
                          "end": 59
                        }
                      }
                    },
                    "span": {
                      "start": 53,
                      "end": 59
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 63
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 64
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 64
  }
}
