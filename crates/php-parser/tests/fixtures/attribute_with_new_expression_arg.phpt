===source===
<?php #[Attr(new Config(debug: false))] function f() {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 12,
                  "start_line": 1,
                  "start_col": 8
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "Config"
                          },
                          "span": {
                            "start": 17,
                            "end": 23,
                            "start_line": 1,
                            "start_col": 17
                          }
                        },
                        "args": [
                          {
                            "name": "debug",
                            "value": {
                              "kind": {
                                "Bool": false
                              },
                              "span": {
                                "start": 31,
                                "end": 36,
                                "start_line": 1,
                                "start_col": 31
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 24,
                              "end": 36,
                              "start_line": 1,
                              "start_col": 24
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 13,
                      "end": 37,
                      "start_line": 1,
                      "start_col": 13
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 13,
                    "end": 37,
                    "start_line": 1,
                    "start_col": 13
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 38,
                "start_line": 1,
                "start_col": 8
              }
            }
          ]
        }
      },
      "span": {
        "start": 40,
        "end": 55,
        "start_line": 1,
        "start_col": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55,
    "start_line": 1,
    "start_col": 0
  }
}
