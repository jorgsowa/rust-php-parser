===source===
<?php

interface A extends C, D {
    public function a();
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "A",
          "extends": [
            {
              "parts": [
                "C"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 27,
                "end": 28,
                "start_line": 3,
                "start_col": 20
              }
            },
            {
              "parts": [
                "D"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 30,
                "end": 32,
                "start_line": 3,
                "start_col": 23
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "a",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 38,
                "end": 59,
                "start_line": 4,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 60,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60,
    "start_line": 1,
    "start_col": 0
  }
}
