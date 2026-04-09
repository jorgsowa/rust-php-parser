===source===
<?php function foo(): (self&Stringable) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Intersection": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "self"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 23,
                        "end": 27,
                        "start_line": 1,
                        "start_col": 23
                      }
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 27,
                    "start_line": 1,
                    "start_col": 23
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "Stringable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 28,
                        "end": 38,
                        "start_line": 1,
                        "start_col": 28
                      }
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 38,
                    "start_line": 1,
                    "start_col": 28
                  }
                }
              ]
            },
            "span": {
              "start": 22,
              "end": 39,
              "start_line": 1,
              "start_col": 22
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 42,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42,
    "start_line": 1,
    "start_col": 0
  }
}
