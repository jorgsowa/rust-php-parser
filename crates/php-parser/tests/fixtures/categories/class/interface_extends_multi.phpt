===source===
<?php interface Foo extends Bar, Baz { public function run(): void; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "Foo",
          "extends": [
            {
              "parts": [
                "Bar"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 28,
                "end": 31
              }
            },
            {
              "parts": [
                "Baz"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 33,
                "end": 36
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "run",
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
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 62,
                          "end": 66
                        }
                      }
                    },
                    "span": {
                      "start": 62,
                      "end": 66
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 39,
                "end": 68
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 69
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69
  }
}
