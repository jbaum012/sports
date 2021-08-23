String.prototype.isLike = function (subString) {
  let lower = this.toLowerCase()
  let lowerSubString = subString.toLowerCase()
  console.log(lower, lowerSubString, lower.includes(lowerSubString));

  return lower.includes(lowerSubString);
};
