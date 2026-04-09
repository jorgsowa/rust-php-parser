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
                "end": 31,
                "start_line": 1,
                "start_col": 28
              }
            },
            {
              "parts": [
                "Baz"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 33,
                "end": 37,
                "start_line": 1,
                "start_col": 33
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
                          "end": 66,
                          "start_line": 1,
                          "start_col": 62
                        }
                      }
                    },
                    "span": {
                      "start": 62,
                      "end": 66,
                      "start_line": 1,
                      "start_col": 62
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 39,
                "end": 68,
                "start_line": 1,
                "start_col": 39
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 69,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69,
    "start_line": 1,
    "start_col": 0
  }
}
