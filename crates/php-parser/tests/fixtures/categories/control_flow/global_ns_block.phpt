===source===
<?php namespace { function main() {} }
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
                    "name": "main",
                    "params": [],
                    "body": [],
                    "return_type": null,
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 18,
                  "end": 36,
                  "start_line": 1,
                  "start_col": 18
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38,
    "start_line": 1,
    "start_col": 0
  }
}
