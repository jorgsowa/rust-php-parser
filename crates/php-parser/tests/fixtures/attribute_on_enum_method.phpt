===config===
min_php=8.1
===source===
<?php enum E { case A; #[Override] public function foo(): void {} }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "E",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "A",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 15,
                "end": 23,
                "start_line": 1,
                "start_col": 15
              }
            },
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
                          "start": 58,
                          "end": 62,
                          "start_line": 1,
                          "start_col": 58
                        }
                      }
                    },
                    "span": {
                      "start": 58,
                      "end": 62,
                      "start_line": 1,
                      "start_col": 58
                    }
                  },
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Override"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 25,
                          "end": 33,
                          "start_line": 1,
                          "start_col": 25
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 25,
                        "end": 33,
                        "start_line": 1,
                        "start_col": 25
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 35,
                "end": 66,
                "start_line": 1,
                "start_col": 35
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67,
    "start_line": 1,
    "start_col": 0
  }
}
