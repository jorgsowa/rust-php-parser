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
                  "end": 36
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
