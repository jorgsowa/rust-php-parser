===source===
<?php interface I { #[Pure] public function foo(): void; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "I",
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": "foo",
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
                          "start": 51,
                          "end": 55,
                          "start_line": 1,
                          "start_col": 51
                        }
                      }
                    },
                    "span": {
                      "start": 51,
                      "end": 55,
                      "start_line": 1,
                      "start_col": 51
                    }
                  },
                  "body": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Pure"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 26,
                          "start_line": 1,
                          "start_col": 22
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 26,
                        "start_line": 1,
                        "start_col": 22
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 57,
                "start_line": 1,
                "start_col": 20
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58,
    "start_line": 1,
    "start_col": 0
  }
}
