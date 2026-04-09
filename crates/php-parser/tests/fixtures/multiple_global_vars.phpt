===source===
<?php
function foo() {
    global $db, $config, $logger;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [
            {
              "kind": {
                "Global": [
                  {
                    "kind": {
                      "Variable": "db"
                    },
                    "span": {
                      "start": 34,
                      "end": 37,
                      "start_line": 3,
                      "start_col": 11
                    }
                  },
                  {
                    "kind": {
                      "Variable": "config"
                    },
                    "span": {
                      "start": 39,
                      "end": 46,
                      "start_line": 3,
                      "start_col": 16
                    }
                  },
                  {
                    "kind": {
                      "Variable": "logger"
                    },
                    "span": {
                      "start": 48,
                      "end": 55,
                      "start_line": 3,
                      "start_col": 25
                    }
                  }
                ]
              },
              "span": {
                "start": 27,
                "end": 57,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 58,
        "start_line": 2,
        "start_col": 0
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
