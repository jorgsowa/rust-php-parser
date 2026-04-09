===source===
<?php
namespace {
    function globalFunc() {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": [
              {
                "kind": {
                  "Function": {
                    "name": "globalFunc",
                    "params": [],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 22,
                  "end": 46,
                  "start_line": 3,
                  "start_col": 4
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48,
    "start_line": 1,
    "start_col": 0
  }
}
