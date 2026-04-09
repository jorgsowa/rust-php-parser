===source===
<?php throw new Exception('Something went wrong');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Throw": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "Exception"
                },
                "span": {
                  "start": 16,
                  "end": 25,
                  "start_line": 1,
                  "start_col": 16
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "String": "Something went wrong"
                    },
                    "span": {
                      "start": 26,
                      "end": 48,
                      "start_line": 1,
                      "start_col": 26
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 26,
                    "end": 48,
                    "start_line": 1,
                    "start_col": 26
                  }
                }
              ]
            }
          },
          "span": {
            "start": 12,
            "end": 49,
            "start_line": 1,
            "start_col": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 50,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50,
    "start_line": 1,
    "start_col": 0
  }
}
