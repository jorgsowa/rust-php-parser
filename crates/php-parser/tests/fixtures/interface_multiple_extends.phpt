===source===
<?php
interface ReadWrite extends Readable, Writable {
    public function flush(): void;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "ReadWrite",
          "extends": [
            {
              "parts": [
                "Readable"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 34,
                "end": 42,
                "start_line": 2,
                "start_col": 28
              }
            },
            {
              "parts": [
                "Writable"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 44,
                "end": 53,
                "start_line": 2,
                "start_col": 38
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "flush",
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
                          "start": 84,
                          "end": 88,
                          "start_line": 3,
                          "start_col": 29
                        }
                      }
                    },
                    "span": {
                      "start": 84,
                      "end": 88,
                      "start_line": 3,
                      "start_col": 29
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 59,
                "end": 90,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 91,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91,
    "start_line": 1,
    "start_col": 0
  }
}
